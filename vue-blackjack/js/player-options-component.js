Vue.component('playeroptions',
    {
        template: '<div class="row pb-1 mt-1">\
            <div class="col-4">\
                <button id="startGameButton" v-if="!gameRunning" @click="startGame">Start New Game</button>\
            </div>\
            <div class="col-4 text-right">\
                <button id="hit" type="button" class="btn btn-primary hitoption" v-if="gameRunning && !playerBust" :disabled="!gameRunning">Hit</button>\
            </div>\
            <div class="col-4">\
                <button id="stick" type="button" class="btn btn-primary stickoption" v-if="gameRunning && !playerBust" :disabled="!gameRunning">Stick</button>\
            </div>\
        </div>',
        props: {
            gameOver: Boolean,
            playerBust: Boolean,
            cardDeck: Array,
            startGame: Function,
            gameRunning: Boolean,
            playerCards: Array,
            dealerCards: Array
        },
        computed: {
            
        },
        methods: {
            
        }
    }
);