<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <style>
    body{
      height: 100%;
      width: 100%;
      display: flex;
      justify-content: center;
    }
    #app{
      margin-top: 20px;
    }
    #app>div{
      height: 400px;
      width: 400px;
      background-color: aliceblue;
      text-align: center;
      border-radius: 5px;
    }
  
    #chat-title{
      padding-top: 20px;
      padding-bottom: 10px;
    }

    #chat-title>h4{
      font-family:Raleway
    }

    #chat-title span{
      padding: 5px 20px 5px 20px;
      background-color: rgba(136, 131, 240, 1);
    }

    .send-chat textarea{
      width: 70%;
    }

    textarea{
      vertical-align: bottom
    }

    .id-chat input{
      width: 20%;
      height: 25px;
      margin-top: 20px;
      margin-bottom: 10px;
    }

    section ul{
      text-align: left;
    }
  </style>
  <body>
    <!-- <h1>Hello, world!</h1> -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <div id="app">
          <div>
              <!-- TODO: Buatlah sebuah header dengan id todo-title -->
              <div id="chat-title">
                  <h4>
                      <span>Doctor Chat</span>
                  </h4>
              </div>
              <!-- Drop Down Button -->
              <!-- <div class="doctor-group">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pilih Dokter ...
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="doctor-item">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
              <script>
                // Constant URL value for JAAS API
                const DOCTOR_API_URL = window.location.hostname + "/api/doctor";
                // Object with RapidAPI authorization headers and Content-Type header
                const DOCTOR_REQUEST_HEADERS = {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                };

                axios.get(`${DOCTOR_API_URL}`, { headers: DOCTOR_REQUEST_HEADERS })
                .then(response => {
                  response.data.forEach((doctor) => {
                    let a = document.createElement("a");
                    a.setAttribute('class', 'dropdown-item')
                    a.setAttribute('href', '#')
                    let textli = document.createTextNode(doctor.name);
                    a.appendChild(textli)
                    doctorItem.appendChild(a)
                    echo(doctor)
                  });
                })
                .catch(error => console.error('On get student error', error))
                // let doctorItem = document.getElementById('doctor-item')
                // fetch(url)
                // .then( res => res.json())
                // .then((data) => {
                //   data.data.forEach((doctor) => {
                //     let a = document.createElement("a");
                //     a.setAttribute('class', 'dropdown-item')
                //     a.setAttribute('href', '#')
                //     let textli = document.createTextNode(doctor.name);
                //     a.appendChild(textli)
                //     doctorItem.appendChild(a)
                //     echo(doctor)
                //   });
                // })
                
                $(".dropdown-menu a").click(function(){
                  $(".btn:first-child").html($(this).text());
                });
              </script> -->
              <div class="id-chat">
                <input type="text" placeholder="Doctor ID" id="doctor-id-input" onkeypress="(fnClickHandler(event))">
                <input type="text" placeholder="User ID" id="user-id-input" onkeypress="(fnClickHandler(event))">
              </div>

              <!-- Section: input -->
              <div class="send-chat">
                  <textarea type="text" placeholder="Ketik Pesan" id="chat-input" onkeypress="(fnClickHandler(event))"></textarea>
                  <button id="todo-submit" onclick="(fnClickHandler(event))">Submit</button>
              </div>
          </div>
      </div>
      <script>
        function fnClickHandler(event) {
          if((event.type == "keypress" && event.key === "Enter") || (event.type === "click")){
            const doctorId = document.getElementById('doctor-id-input').value;
            const userId = document.getElementById('user-id-input').value;
            const pesan = document.getElementById('chat-input').value;
            // Constant URL value for JAAS API
            const CHAT_API_URL = "/api/doctor/chat/send/";
            // Object with RapidAPI authorization headers and Content-Type header
            const CHAT_REQUEST_HEADERS = {
              'Accept': 'application/json', 
              'Content-Type': 'application/json'
            };
            const payload = {
              'doctor_id': doctorId, 
              'user_id': userId,
              'message': pesan
            };
            // Making a POST request using an axios instance from a connected library
            axios.post(CHAT_API_URL, payload, { headers: CHAT_REQUEST_HEADERS })
              // Handle a successful response from the server
              .then(response => {
                alert(response.data.message);
              })
              // Catch and print errors if any
              .catch(error => {
                alert(error)
              });
          }
        }
      </script>
  </body>
</html>