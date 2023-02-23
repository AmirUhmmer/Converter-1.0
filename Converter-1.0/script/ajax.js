
        var form = document.getElementById('form')
        form.addEventListener('submit', function(event) {
            event.preventDefault()
            var input = document.getElementById('input_text').value
            var url = "";
            if(isNaN(input)){
                url = 'php/word_contr.php';
            }
            else{     
                url = 'php/num_contr.php';
            }

            $.ajax({
                url : url,
                dataType: 'json',
                type: 'POST',
                data : {user_input:input},
                success: function(res){
                    document.querySelector("#output").innerHTML = res["final_output"];
                    document.querySelector("#converted").innerHTML = " $" + res["usd"];
                    document.getElementById('input_text').value = ''
                    show_history()
                }
            })

        })


        function show_history(){
            $.ajax({
                type: 'GET',
                url: 'php/history.php',
                dataType: 'html',
                success: function (data) {
                    $('#history').html(data);
                }
            })
        }
        