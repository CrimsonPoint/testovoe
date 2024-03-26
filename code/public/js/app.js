const app = new Vue({
    el: '#app',
    data: {
        inputString: '',
        history: [].reverse(),
        inputErr : ''
    },
    created() {
        this.fetchHistory(); 
    },
    methods: {
        checkBrackets() {
            console.log(this.inputErr)
                if(this.inputString.replace(/\s+/g, '')){
                    fetch('http://localhost:8080/index.php', {
                        method: 'POST',
                        body:  JSON.stringify({data: this.inputString , dataRaw: this.inputString}),
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.history.unshift({ query: this.inputString, result: data.success, dataRaw: data.data });
                        this.inputString = ''; 
                    })
                    .catch(err => console.log('err-log:', err));

                    this.inputErr = '';
                }
                else{
                    this.inputErr = 'Ошибка, введите данные :P';
                    this.inputString = '';
                }
                
        },
        fetchHistory() {
            fetch('http://localhost:8080/getData.php')
                .then(response => response.json())
                .then(data => {
                    this.history = data.reverse();
                })
                .catch(err => console.error('ping!', err));
        }
    }
});