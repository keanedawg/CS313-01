var picID = 0;

function increment() {
  picID++;
  picID = picID % 4;
  choose_picture()
};

function decrement() {
  picID--;
  if(picID == -1) {
    picID = 4;
  }
  choose_picture();
};

function choose_picture() {
  if(picID == 0) {
    document.getElementById("photo_back").innerHTML = "<img id=\"portrait\" src=\"images\\me.jpg\">";
  }
  else if(picID == 1) {
    document.getElementById("photo_back").innerHTML = "<img id=\"portrait\" src=\"images\\Boston_University.jpg\">";
  }
  else if(picID == 2) {
    document.getElementById("photo_back").innerHTML = "<img id=\"portrait\" src=\"images\\Cameron.jpg\">";
  }
  else if(picID == 3)  {
    document.getElementById("photo_back").innerHTML = "<img id=\"portrait\" src=\"images\\San_Francisco.jpg\">";
  }
};