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

const renderCalender = () => {
  const calendar = document.querySelector('.booking_calendar_main_container');

  if (calendar) {
    const entryContent = document.querySelector('.entry-content');
    calendar.remove();
    const wrapper = createElement1('div', 'calendar-wrapper');
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
  }
};
renderCalender();
