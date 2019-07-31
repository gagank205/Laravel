<!doctype html>
<html lang="en">

<!-- -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home - ClinicalTrials.gov</title>

    <!-- Fonts Online -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet'
        type='text/css'>
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->

    <!-- Style Sheet -->

    <link rel="stylesheet" href="{{('new/css/main.css')}}">
    <link rel="stylesheet" href="{{('new/css/styles.css')}}">





</head>

<body class="from-bg">
    <section class="form-head">
        <div class="bck-btn"><a href="{{('web')}}"><i class="fa fa-angle-left"></i></a></div>
        <div class="form-menu">
            <div class="dropdown ">
                <img src="{{('new/images/menuIcon.svg')}}" onclick="myFunction()" class="dropbtn">
                <div id="myDropdown" class="dropdown-content">
                    <a href="#">Frequent Questions</a>
                    <a href="#">Talk to Us</a>
                    <a href="#">Add Promo Code</a>
                    </ul>
                </div>
                <script>
                    function myFunction() {
                        document.getElementById("myDropdown").classList.toggle("show");
                    }
                    window.onclick = function (event) {
                        if (!event.target.matches('.dropbtn')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show')) {
                                    openDropdown.classList.remove('show');
                                }
                            }
                        }
                    }
                </script>
            </div>
        </div>
    </section>
    <section>
        <div class="content form">
            <form>
                <div class="form-label">Let's get to know you</div>
                <div class="form-group">
                    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="First Name">
                </div>
                <div class="form-group">
                    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Last Name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email">
                </div>
                <div class="form-check">
                </div>
                <div class="bottom-button-container">
                    <button type="submit" class="btn btn-primary form-btn">Pick Photos →</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>