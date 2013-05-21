// JavaScript Document

var x;



var d=new Date().getDay();



switch (d)



  {



  case 0:



    x="<strong>Sunday:</strong> Closed<br /><br /><br /><br />< br/>";



    break;



  case 1:



    x="<strong>Monday<br /> <br /> Soups: </strong>Potato Dill and Tomato Basil<br /><br /><strong>Coffee:</strong> Vermont Maple, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  case 2:



    x="<strong>Tuesday<br /> <br /> Soups: </strong>Stuffed Green Pepper and Tomato Basil<br /><br /><strong>Coffee:</strong> Creamy Caramel, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  case 3:



    x="<strong>Wednesday<br /> <br /> Soups: </strong>Timberline Chili and Tomato Basil<br /><br /><strong>Coffee:</strong> Jamaican Me Crazy, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  case 4:



    x="<strong>Thursday<br /> <br /> Soups: </strong>Vegetarian Vegetable and Tomato Basil<br /><br /><strong>Coffee:</strong> Blueberry Streusel, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  case 5:



    x="<strong>Friday<br /> <br /> Soups: </strong> Broccoli Cheddar and Tomato Basil<br /><br /><strong>Coffee:</strong> Chocolate Banana Hazelnut, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  case 6:



    x="<strong>Saturday<br /> <br /> Soups: </strong>Chicken Tortilla and Tomato Basil<br /><br /><strong>Coffee:</strong> Vanilla Almond Praline, Dark Roast, House Blend and Decaf. <br /><br /><br />";



    break;



  }



document.getElementById("datecontent").innerHTML=x;