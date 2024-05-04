var card = document.querySelectorAll('.memberCard');
var verification = false;

for (let i = 0; i < card.length; i++) {
    card[i].onmouseenter = function(){
        var description = this.querySelector('.member-description');
        description.classList.add("description-hovered");
        description.querySelector(".arrow").classList.add("arrow-hovered");

        verification = true;
        //apparition du text lors du hover
        var textPresentation  = description.querySelector(".globalDescription");
        setTimeout(function(){
            if(verification){
              textPresentation.style.display = "block";
              textPresentation.animate([
                  { opacity : 0},
                  { opacity : 1 }
                ], {
                  duration: 500,
                });

                setTimeout(function(){ if(verification){textPresentation.style.opacity = 1}}.bind(this),500);

            }
        }.bind(this),1000);
     }
     


     /*On leave la card*/
     card[i].onmouseleave = function(){
        /*Declaration var*/
        var description = this.querySelector('.member-description');
        var textPresentation  = description.querySelector(".globalDescription");
        verification = false;

        /*Animation effacement texte*/
        textPresentation.animate([
            { opacity : 1},
            { opacity : 0}
          ], {
            duration: 100,
          });

          textPresentation.style.opacity = 0;

        /*On remet tout en ordre*/
        setTimeout(function(){
            //apparition du text lors du hover
            textPresentation.style.display = "none";

            description.classList.remove("description-hovered");
            description.querySelector(".arrow").classList.remove("arrow-hovered");  
        }.bind(this),100)
     }
}