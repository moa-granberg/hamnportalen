const editFormText = () => {
  const submitButton = document.querySelector(".wpdevart-form-section > button[type='submit']");
  if (submitButton) {
    submitButton.innerText = 'Boka';
    const infoText = document.querySelector('#check-info-1');
    infoText.innerText = 'Välj dagar i kalendern';
  }
};

editFormText();

const createElement1 = (el, className) => {
  const newEl = document.createElement(el);
  newEl.classList.add(className);
  return newEl;
};

const renderCalendar = () => {
  const calendar = document.querySelector('.booking_calendar_main_container');

  if (calendar) {
    const entryContent = document.querySelector('.port-main-wrapper');
    calendar.remove();
    const wrapper = createElement1('div', 'calendar-wrapper');
    wrapper.classList.add('port-booking');
    const wrapperhead = createElement1('div', 'calendar-wrapper__header');
    const h2 = createElement1('h2', 'calendar-wrapper__h2');
    h2.innerText = 'DIREKTBOKNING';
    entryContent.appendChild(wrapper);
    wrapper.appendChild(wrapperhead);
    wrapperhead.appendChild(h2);
    wrapper.appendChild(calendar);
    calendar.classList.add('hide');

    wrapperhead.addEventListener('click', () => {
      calendar.classList.toggle('hide');
    });

    document.querySelector('#wpdevart-submit1').addEventListener('click', () => submitForm());
  }
};

const validEmail = email => {
  const regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
  return email.match(regex);
};

const submitForm = () => {
  const checkIn = document.querySelector('#wpdevart_form_checkin1').value;
  const checkOut = document.querySelector('#wpdevart_form_checkout1').value;
  const boatSize = document.querySelector('#wpdevart_extra_field3').value;
  const name = document.querySelector('#wpdevart_form_field1').value;
  const surname = document.querySelector('#wpdevart_form_field2').value;
  const email = document.querySelector('#wpdevart_form_field3').value;
  const phone = document.querySelector('#wpdevart_form_field4').value;

  if (checkIn && checkOut && boatSize && name && surname && phone && validEmail(email)) {
    window.location.href = `${window.location.href.split('blog')[0]}bokningsbekraftelse`;
  }
};

if (!window.location.href.includes('wp-admin')) {
  editFormText();
  renderCalendar();
}
