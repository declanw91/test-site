var cardArray = [];
var playerCards = [];
var dealerCards = [];

function resetTheDecks() {
  cardArray = [];
  playerCards = [];
  dealerCards = [];
  var suits = ["clubs", "spades", "hearts", "diamonds"];
  for(var i = 0; i < suits.length; i++) {
    for(var j = 1; j <= 13; j++) {
      var cardDetails = {};
      if(j == 1) {
        cardDetails.name = "ace";
        cardDetails.value = j;
        cardDetails.hiValue = 11;
      } else if (j > 10) {
        if(j == 11) {
          cardDetails.name = "jack";
          cardDetails.value = 10;
          cardDetails.hiValue = 10;
        } else if (j == 12) {
          cardDetails.name = "queen";
          cardDetails.value = 10;
          cardDetails.hiValue = 10;
        } else if (j == 13) {
          cardDetails.name = "king";
          cardDetails.value = 10;
          cardDetails.hiValue = 10;
        }
      } else {
        cardDetails.name = j;
        cardDetails.value = j;
        cardDetails.hiValue = j;
      }
      cardDetails.suit = suits[i]; 
      cardArray.push(cardDetails);
    }
  }
}

function getRandomCard() {
  var randomCard = null;
  var rand = Math.floor(Math.random() * cardArray.length);
  return cardArray[rand];
}

function drawCard(user) {
  var card = getRandomCard();
  if(user === 'player') {
    playerCards.push(card);
  } else if (user === 'dealer') {
    dealerCards.push(card);
  }
}

function calculateScore(cards) {
  var lowScore = 0;
  var highScore = 0;
  for(var i = 0; i < cards.length; i++) {
    lowScore = lowScore + cards[i].value;
    highScore = highScore + cards[i].hiValue;
  }
  return {"lowScore": lowScore, "highScore": highScore};
}

function playerDrawCard() {
  drawCard("player");
}

function dealerDrawCard() {
  drawCard("dealer");
}

function displayCards(user, cards) {
  var htmlString = '';
  for(var i = 0; i < cards.length; i++) {
    htmlString = htmlString + '<p class="cardWrapper">' + cards[i].name + ' of ' + cards[i].suit + '</p>'
  }
  if(user === 'player') {
    jQuery('.playercards').html(htmlString);
  } else if (user === 'dealer') {
    jQuery('.dealercards').html(htmlString);
  }
}

function updateScore(user, cards) {
  var scores = calculateScore(cards);
  var htmlString = ''; 
  var highScore = scores.highScore;
  var lowScore = scores.lowScore;
  if(lowScore === highScore) {
    htmlString = lowScore;
  } else if (lowScore < highScore) {
    htmlString = lowScore + " or " + highScore;
  }
  if(user === 'player') {
    jQuery('.playertotal').html(htmlString);
  } else if (user === 'dealer') {
    jQuery('.dealertotal').html(htmlString);
  }
  if (lowScore > 21 && highScore > 21){
    jQuery('.controls').hide();
    if(user === 'player') {
      alert("You are bust. Thanks for playing");
    } else if (user === 'dealer') {
      alert("Dealer is bust. You win!. Thansk for playing");
    }
    jQuery('.controls').hide();
  } else if (lowScore === 21 || highScore === 21) {
    if(user === 'player') {
      alert("You have 21, you win! Thanks for playing");
    } else if (user === 'dealer') {
      alert("Dealer has 21, you lose. Thanks for playing");
    }
    jQuery('.controls').hide();
  }
}

function startGame() {
  resetTheDecks();
  drawCard("player");
  drawCard("player");
  drawCard("dealer");
  displayCards("player", playerCards);
  displayCards("dealer", dealerCards);
  updateScore("player", playerCards);
  updateScore("dealer", dealerCards);
  jQuery('.controls').show();
  jQuery('#gamearea').show();
}

function playerHits() {
  drawCard("player");
  displayCards("player", playerCards);
  updateScore("player", playerCards);
}

function playerSticks() {
  var playerScores = calculateScore(playerCards);
  var dealerScores = calculateScore(dealerCards);
  var delay = 1000; //1 second
  if((dealerScores.lowScore <= playerScores.lowScore || dealerScores.highScore <= playerScores.highScore) && (dealerScores.lowScore < 21 && dealerScores.highScore < 21)) {
    setTimeout(function() {
      drawCard("dealer");
      displayCards("dealer", dealerCards);
      updateScore("dealer", dealerCards);
      playerSticks()
    }, delay);
  } else if ((dealerScores.lowScore > playerScores.lowScore || dealerScores.highScore > playerScores.highScore) && (dealerScores.lowScore < 21 && dealerScores.highScore < 21)) {
    jQuery('.controls').hide();
    alert("Dealer has higher hand, you lose. Thanks for playing.");
  }
}

jQuery('document').ready(function(){
  jQuery('#startGame').click(function(){
    startGame();
  });
  jQuery('#hit').click(function(){
    playerHits();
  });
  jQuery('#stick').click(function(){
    playerSticks();
  });
});