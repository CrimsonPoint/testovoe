const app = new Vue({
    el: '#app',
    data: {
        inputString: ' ',
        history: [].reverse()
    },
    created() {
        this.fetchHistory(); 
    },
    methods: {
        checkBrackets() {
                //console.log('!' + this.changeData() + '!');
                //console.log('ping');
                fetch('http://localhost:8080/index.php', {
                    method: 'POST',
                    body:  JSON.stringify({data: this.changeData() , dataRaw: this.inputString}),
                    headers: {
                        'Content-Type': /*'text/plain'*/ 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    this.history.unshift({ query: this.inputString, result: data.success, dataRaw: data.data });
                    this.inputString = ''; 
                })
                .catch(err => console.log('err-log:', err));
        },
        fetchHistory() {
            fetch('http://localhost:8080/getData.php')
                .then(response => response.json())
                .then(data => {
                    this.history = data.reverse();
                })
                .catch(err => console.error('ping!', err));
        },
        changeData(){
            const breckets = ["(","[","{","<",">","]","}",")"];
            return (this.inputString.split('').filter((e) => {
                return breckets.indexOf(e) != -1;
            }).join(''));
        }
    }
});