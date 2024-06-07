/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        transparent: 'transparent',
        transpb: '#14131e38',
        graytr:'#000000eb',
        graytrlight:'#3a41496b',
        whitetr:'#f9fafbcc',
        whflow:'#ffffff0a'
      },
      fontFamily: {
        cairo:['Cairo'],
        rawy:['rawy-bold'],
        reem:['Reem Kufi'],
        roqaa:['Aref Ruqaa']
      },
      spacing: {
        '190':'100rem',
        '180':'1020px',
        '150': '44rem',
        '145':'676px',
        '140':'40rem',
        '130': '36rem',
        '128': '32rem',
        '120': '390px',
        '124': '440px',
        '122': '415px',
        '22': '85px',
        'l99':'99%',
        'l97': '98%',
        'h95':'97%',
        'h90':'93%',
        'tools':'91%',
        'b90':'90%',
        'pagecontain':'87%'
      },
      boxShadow: {
        '5xl': '0px 9px 28px 0px #b9b9b9',
        '3xl':'0px 10px 23px 0px #c7c7c7'
      },
    },
  },
  plugins: [],
}

