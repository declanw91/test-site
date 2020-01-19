Vue.component('gamedisplayarea',
    {
        template: '<div class="row">\
            <div id="playerCardArea" class="col-12"><h1>Player Cards</h1><playingcard v-for="(card, index) in playerCards"/></div>\
            <div id="dealerCardArea" class="col-12"><h1>Dealer Cards</h1><playingcard v-for="(card, index) in playerCards"/></div>\
        </div>',
        props:[
            'playerCards',
            'dealerCards'
        ],
        methods: {

        }
    }
);