window.addEventListener('load', () => {


  console.log('skriptet körs!!!');
  function extractSearchParam() {
    const url = window.location.href;
    console.log('href: ', url);
    const regex = /params=(.*)/
    return url.match(regex)[1].split('').slice(0, this.length -1 ).join('')

  }
  
  const list = async () => {
    const param = extractSearchParam()
    console.log(param);
    const url = `http://localhost/hamnportalen_local/wp-json/mapsearch/search/${param}`
    const result = await fetch(url).then(data => data.json())
    console.log(result);
  }
  list()

})