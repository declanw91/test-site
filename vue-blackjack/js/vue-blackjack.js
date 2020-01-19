new Vue(
    {
        el: '#gamearea',
        data: {
            playerCards: [''],
            dealerCards: [''],
            cardDeck: [''],
            playerScore: 0,
            dealerScore: 0,
            dealerBust: false,
            playerBust: false,
            gameOver: false,
            gameRunning: false
        },
        methods: {
            createCardDeck: function () {
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
                    this.cardDeck.push(cardDetails);
                  }
                }
            },
            startGame: function() {
                this.gameRunning = true;
            }
        },
        mounted: function() {
            this.createCardDeck();
        }
    }
);