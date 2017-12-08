/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 *
 */



var loser = null;  // whether the user has hit a wall
var startflag = false;

window.onload = function() {
  "use strict";
  $("start").addEventListener('click', startClick);

  document.body.observe("mouseover",overBody);
  var Boundaryies = $$("#maze .boundary");

  for(var i = 0; i < Boundaryies.length; i++){
    Boundaryies[i].addEventListener("mouseover", overBoundary);
  }

  $("end").addEventListener("mouseover", overEnd);

};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {
  "use strict";
  if(startflag !== false && loser !== true){
      var Boundaryies = $$('#maze .boundary'); //html을 가져오는 부분
      for(var i = 0; i < Boundaryies.length; i++){
        Boundaryies[i].addClassName('youlose');//css를 가져오는 부분

      }

      $("status").textContent = 'you lose:(!';
      loser = true;
  }
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
  "use strict";
  startflag = true;
  loser = null;

  $("status").textContent = "Click the \"S\" to begin.";
  var Boundaryies = $$('#maze .boundary');
  // console.log("Boundaries",Boundaryies);
  for(var i = 0; i < Boundaryies.length; i++){
      Boundaryies[i].removeClassName('youlose');
  }
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
  "use strict";
  if( loser !== true){
    loser = true;
    $("status").textContent = 'you win:)!';
  }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  "use strict";
  // console.log('event.element()',event.element());
  if(startflag === true && event.element() === document.body){
    overBoundary(event);
  }
}
