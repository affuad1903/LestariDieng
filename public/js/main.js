document.addEventListener("DOMContentLoaded", function() {
    const header = document.getElementById("headerBg");
    window.addEventListener("scroll", function() {
      if (window.scrollY < 50) {
        header.classList.add("bg-transparent");
        header.classList.remove("bg-white", "shadow-md");
        header.classList.add("text-white");
        header.classList.remove("text-dark");
      } else {
        header.classList.remove("bg-transparent");
        header.classList.add("bg-white", "shadow-md");
        header.classList.remove("text-white");
        header.classList.add("text-dark");
      }
    });
});

function mouseOverGaleri(parentElement){
  let content = parentElement.children[1];
  if( content.style.maxHeight==0){
      content.style.maxHeight = content.scrollHeight + "px";
      content.style.opacity=1;
  }
}
function mouseOutGaleri(parentElement){
  let content = parentElement.children[1];
  if( content.style.maxHeight){
      content.style.maxHeight= null;
      content.style.opacity=0;
  }
}
function onclickGaleri(parentElement){
  let content = parentElement.children[1];
  if( content.style.maxHeight==0){
      content.style.maxHeight = content.scrollHeight + "px";
      content.style.opacity=1;
  }else if( content.style.maxHeight){
    content.style.maxHeight= null;
    content.style.opacity=0;
  }
}