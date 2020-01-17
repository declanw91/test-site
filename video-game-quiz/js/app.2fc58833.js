(function(e){function t(t){for(var r,i,a=t[0],u=t[1],c=t[2],d=0,f=[];d<a.length;d++)i=a[d],Object.prototype.hasOwnProperty.call(s,i)&&s[i]&&f.push(s[i][0]),s[i]=0;for(r in u)Object.prototype.hasOwnProperty.call(u,r)&&(e[r]=u[r]);l&&l(t);while(f.length)f.shift()();return o.push.apply(o,c||[]),n()}function n(){for(var e,t=0;t<o.length;t++){for(var n=o[t],r=!0,a=1;a<n.length;a++){var u=n[a];0!==s[u]&&(r=!1)}r&&(o.splice(t--,1),e=i(i.s=n[0]))}return e}var r={},s={app:0},o=[];function i(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.m=e,i.c=r,i.d=function(e,t,n){i.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},i.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,t){if(1&t&&(e=i(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)i.d(n,r,function(t){return e[t]}.bind(null,r));return n},i.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return i.d(t,"a",t),t},i.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},i.p="/";var a=window["webpackJsonp"]=window["webpackJsonp"]||[],u=a.push.bind(a);a.push=t,a=a.slice();for(var c=0;c<a.length;c++)t(a[c]);var l=u;o.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"016c":function(e,t,n){"use strict";var r=n("f0f9"),s=n.n(r);s.a},"034f":function(e,t,n){"use strict";var r=n("85ec"),s=n.n(r);s.a},"0e5c":function(e,t,n){"use strict";var r=n("872a"),s=n.n(r);s.a},"49fd":function(e,t,n){},"56d7":function(e,t,n){"use strict";n.r(t);var r=n("2b0e"),s=n("5f5b"),o=(n("f9e3"),n("2dd8"),function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("Header",{attrs:{numCorrectAnswers:e.numCorrectAnswers,totalAnswers:e.totalAnswers}}),n("b-container",{staticClass:"bv-example-row"},[n("b-row",[n("b-col",{attrs:{sm:"6",offset:"3"}},[e.questions.length?n("QuestionBox",{attrs:{currentQuestion:e.questions[e.index],nextQuestion:e.nextQuestion,increment:e.increment,totalAnswers:e.totalAnswers}}):e._e()],1)],1)],1),n("GameOverModal",{attrs:{numCorrectAnswers:e.numCorrectAnswers,totalAnswers:e.totalAnswers,resetGame:e.resetGame}})],1)}),i=[],a=(n("d3b7"),n("e6cf"),function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"navbar-wrapper"},[n("b-navbar",{attrs:{toggleable:"lg",type:"dark"}},[n("b-navbar-brand",{attrs:{href:"#"}},[n("img",{attrs:{alt:"Quiz Logo",src:"img/game-controller-icon.png",width:"50"}}),n("span",{attrs:{id:"quizTitleText"}},[e._v("Video Game Quiz Time!")])]),n("b-nav-text",[n("span",{staticClass:"totalAnswersMessage"},[e._v("Correct Answers: "+e._s(e.numCorrectAnswers)+"/"+e._s(e.totalAnswers))])])],1)],1)}),u=[],c={props:["numCorrectAnswers","totalAnswers"]},l=c,d=(n("016c"),n("2877")),f=Object(d["a"])(l,a,u,!1,null,"064e8329",null),p=f.exports,h=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"question-box-wrapper"},[n("b-jumbotron",{scopedSlots:e._u([{key:"lead",fn:function(){return[n("span",{domProps:{innerHTML:e._s(e.currentQuestion.question)}})]},proxy:!0}])},[n("hr",{staticClass:"my-4"}),n("b-list-group",e._l(e.shuffledAnswers,(function(t,r){return n("b-list-group-item",{key:r,class:e.answerClass(r),on:{click:function(t){return e.selectAnswer(r)}}},[n("span",{domProps:{innerHTML:e._s(t)}})])})),1),n("b-button",{attrs:{variant:"primary",disabled:null===e.selectedIndex||e.answered},on:{click:e.submitAnswer}},[e._v("Submit")]),n("b-button",{attrs:{variant:"success",href:"#",disabled:!e.answered||this.totalAnswers>=10},on:{click:e.nextQuestion}},[e._v("Next")])],1)],1)},w=[],m=(n("99af"),n("c975"),n("a9e3"),n("2909")),b=n("2ef0"),v=n.n(b),A={props:{currentQuestion:Object,nextQuestion:Function,increment:Function,totalAnswers:Number},data:function(){return{selectedIndex:null,shuffledAnswers:[],answered:!1,correctIndex:null}},computed:{answers:function(){var e=Object(m["a"])(this.currentQuestion.incorrect_answers);return e.push(this.currentQuestion.correct_answer),e}},watch:{currentQuestion:{immediate:!0,handler:function(){this.selectedIndex=null,this.answered=!1,this.shuffleAnswers()}}},methods:{selectAnswer:function(e){this.selectedIndex=e},shuffleAnswers:function(){var e=[].concat(Object(m["a"])(this.currentQuestion.incorrect_answers),[this.currentQuestion.correct_answer]);this.shuffledAnswers=v.a.shuffle(e);var t=this.currentQuestion.correct_answer;this.correctIndex=this.shuffledAnswers.indexOf(t)},submitAnswer:function(){var e=!1;this.selectedIndex===this.correctIndex&&(e=!0),this.answered=!0,this.increment(e)},answerClass:function(e){var t="";return this.answered||this.selectedIndex!==e?this.answered&&this.correctIndex===e?t="correctAnswer":this.answered&&this.selectedIndex===e&&this.correctIndex!==e&&(t="incorrectAnswer"):t="selectedAnswer",t}}},x=A,g=(n("0e5c"),Object(d["a"])(x,h,w,!1,null,"5b1336b2",null)),_=g.exports,y=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"gameOverModalWrapper"}},[n("b-modal",{attrs:{id:"game-over-modal","no-footer":"","ok-only":"",title:"Thank you for playing!","ok-title":"Reset"},on:{hidden:e.resetGame}},[n("div",{attrs:{id:"playerResults"}},[n("span",{staticClass:"totalAnswersMessage"},[e._v("Your score: "+e._s(e.numCorrectAnswers)+"/"+e._s(e.totalAnswers))])]),n("div",{attrs:{id:"gameResetMessage"}},[e._v(' Please click "Reset" below to restart the quiz ')])])],1)},O=[],Q={props:["numCorrectAnswers","totalAnswers","resetGame"]},C=Q,j=(n("6036"),Object(d["a"])(C,y,O,!1,null,"4ef36294",null)),k=j.exports,M={name:"app",components:{Header:p,QuestionBox:_,GameOverModal:k},data:function(){return{questions:[],index:0,numCorrectAnswers:0,totalAnswers:0}},methods:{nextQuestion:function(){this.index++},increment:function(e){e&&this.numCorrectAnswers++,this.totalAnswers++,this.checkForGameOver()},resetGame:function(){this.index=0,this.numCorrectAnswers=0,this.totalAnswers=0,this.getQuizQuestions()},checkForGameOver:function(){this.totalAnswers>=10&&this.$bvModal.show("game-over-modal")},getQuizQuestions:function(){var e=this;fetch("https://opentdb.com/api.php?amount=10&category=15&type=multiple",{method:"GET"}).then((function(e){return e.json()})).then((function(t){e.questions=t.results}))}},mounted:function(){this.getQuizQuestions()}},I=M,G=(n("034f"),Object(d["a"])(I,o,i,!1,null,null,null)),P=G.exports;r["default"].use(s["a"]),r["default"].config.productionTip=!1,new r["default"]({render:function(e){return e(P)}}).$mount("#app")},6036:function(e,t,n){"use strict";var r=n("49fd"),s=n.n(r);s.a},"85ec":function(e,t,n){},"872a":function(e,t,n){},f0f9:function(e,t,n){}});
//# sourceMappingURL=app.2fc58833.js.map