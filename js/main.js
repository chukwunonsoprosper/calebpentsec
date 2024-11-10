function shareto(x, y) {
  if (x == "twitter") {
    let textToShare = "check out this blog on cyber security";
    let link = y;
    const twitterShareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(
      textToShare
    )}&url=${encodeURIComponent(link)}`;
    window.open(twitterShareUrl, "_blank");
  } else if (x == "facebook") {
    let textToShare = "check out this blog on cyber security";
    let link = y;
    const facebookShareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
      link
    )}&quote=${textToShare}`;
    window.open(facebookShareUrl, "_blank");
  } else {
    console.log("an error has occur");
  }
}

function searchBlog(event) {
  // console.log(event)
  let input = document.getElementById("inputBar").value;
  try {
    if (input == "") throw "input is blank";
    if (event.code == "Enter") {
      //initialize the endpoint
      async function fetchBlog() {
        let url = `http://localhost/blog/search.php?search_query=${input}`;
        let option = {
          method: "POST",
        };

        try {
          let request = await fetch(url, option);
          let response = await request.text();
          document.getElementById("news").innerHTML = response;
        } catch (error) {
          console.log("an error has occur");
        }
      }
      fetchBlog();
    }
  } catch (e) {
    console.log("an error has occur");
  }
}

function showNav() {
  let navigation = document.getElementById('sideNav');
  navigation.style.display = 'block'
}

function hideNav() {
  let navigation = document.getElementById('sideNav');
  navigation.style.display = 'none'
}

function showNat(){ 
  alert(1)
}