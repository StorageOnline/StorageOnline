@extends('layouts.app')


    <h1>Игра 1</h1>
    <div class="game">
        <hr>
        <h2>Ваш результат: @{{ sum }}</h2>
        <app-progress v-bind:val="sum"
                      v-bind:max="maxNumbers * 5">
        </app-progress>
        <button class="btn btn-success"
                v-on:click="addNumber"
                v-bind:disabled="done">
            Add Number
        </button>
        {{--<button class="btn btn-danger"
                v-on:click="restartGame"
                v-bind:disabled="!done">
            Restart Game
        </button>--}}
        <hr>

        <h2>Количество попыток: @{{ 10 - numbers.length }}</h2>
        <app-progress v-bind:val="numbers.length"
                      v-bind:max="maxNumbers">
        </app-progress>
        <hr>
        <ul class="list-group">
            <li class="list-group-item"
                v-for="number in numbers">
                @{{ number }}
            </li>
        </ul>
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script>
    Vue.component('app-progress', {
        props: {
            max: Number,
            val: Number,
        },
        computed: {
            width(){
                let w = this.val / this.max * 100;

                if(w > 100) {
                    w = 100;
                } else if(w < 0) {
                    w = 0;
                }
                return {
                    width: w + '%',
                }
            },
        },
        template: `
            <div class="progress">
                <div class="progress-bar" v-bind:style="width"></div>
            </div>
        `
    });

    let game = new Vue({
        el: '.game',
        // данные
        data: {
            showH2: true,
            numbers: [],
            maxNumbers: 10,
        },
        // методы
        methods: {
            addNumber(){
                if(!this.done){
                    let rnd = Math.floor(Math.random() * 6);
                    this.numbers.push(rnd);
                }
            },
            restartGame(){
                this.numbers.length = 0;
            }
        },
        // вычисляемые свойства (вычисляются без пересчета всех данных экземпляра класса VUE
        // обновляется только в том случае, если нужно её пересчитать
        computed: {
            sum(){
                console.log(1);
                let sum = 0;
                for( let i = 0; i < this.numbers.length; i++){
                    sum += this.numbers[i];
                }

                return sum;
            },
            btnTexts(){
                return this.showH2? 'Скрыть' : 'Показать'
            },
            done(){
                return this.numbers.length >= this.maxNumbers;
            },
        }
    });
</script>