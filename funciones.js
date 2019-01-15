$(document).ready(iniciar);
function iniciar() {
    $("#buttonIni1").click(followingStep);
    inicialitzaformulari1();
    $("#form1").valid();
    $("#divForm3").hide();
    inicialitzaSlick();
}
function inicialitzaSlick() {
    $('#your-class').slick({
        dots: false,
        accessibility: false,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        slideToShow: 1,
        slideToScroll: 1
    });
}

function inicialitzaformulari1() {
    $("#form1").validate({
        focusCleanup: true,
        rules: {
            name: {
                required: true,
                minlength: 1
            },
            surname: {
                required: true
            },
            username: {
                required: true
            },
            code: {
                required: true,
                minlength: 4,
                maxlength: 16
            },
            surcode: {
                required: true
            },
            city: {
                required: true
            },
            type: {
                required: true
            },
            sex: {
                required: true
            },
            bday: {
                required: true
            },
            nomArtM: {
                required: true
            }
        },
        messages: {
            name: {
                required: " * ",
                minlength: "MINIMO 1 CARACTERES"
            },
            surname: {
                required: " * "
            },
            username: {
                required: " * "
            },
            code: {
                required: " * ",
                minlength: "MINIMO 4 CARACTERES",
                maxlength: "MAXIMO 16 CARACTERES"
            },
            surecode: {
                required: " * "
            },
            city: {
                required: " * "
            },
            type: {
                required: " * "
            },
            sex: {
                required: " * "
            },
            bday: {
                required: " * "
            },
            nomArtM: {
                required: " * "
            }
        }
    });
}

function funcHideRegis() {
    $("#regis").toggle();
    $("#logy").toggle();
    $("#divForm2").toggle();
    $("#divForm3").toggle();
}

function followingStep() {
    if ($("#nameR").val().length == 0) {
        alert("Debes introducir un nombre");
    } else {
        if ($("#surnameR").val().length == 0) {
            alert("Debes introducir un apellido");
        } else {
            if ($("#passwordR").val().length < 4) {
                alert("Debes introducir una contraseña");
            } else {
                if ($("#usernameR").val().length == 0) {
                    alert("Debes introducir un nombre de usuario");
                } else {
                    if ($("#passwordR2").val() != $("#passwordR").val()) {
                        alert("Debes introducir bien las contraseñas");
                    } else {
                        var tipo = document.getElementById("tipoU").value;
                        if (tipo === '3') {
                            $("#fff").hide();
                            $("#formFan").css("display", "block");
                        } else if (tipo === '1') {
                            $("#fff").hide();
                            $("#formMusico").css("display", "block");
                        } else if (tipo === '2') {
                            $("#fff").hide();
                            $("#formLocal").css("display", "block");
                        }
                        $("#buttonIni3").show();
                    }
                }
            }
        }
    }
}
