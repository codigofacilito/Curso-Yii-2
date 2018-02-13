$(function () {
var Clock = {
    totalSeconds: 0,
    start: function () {
        var self = this;

        this.interval = setInterval(function () {
            self.totalSeconds += 1;

            $horas = Math.floor(self.totalSeconds / 3600);
            $minutos = Math.floor(self.totalSeconds / 60 % 60);
            $segundos = parseInt(self.totalSeconds % 60);
            $texto = $horas + ":" + $minutos + ":" + $segundos;
            $('#interrupcion').val($texto);
        }, 1000);
    },
    pause: function () {
        clearInterval(this.interval);
        delete this.interval;
    },
    resume: function () {
        if (!this.interval)
            this.start();
    }
};
    var inicio = true;
    $('#btnIniciar').click(function () {
        $('#btnIniciar').prop("disabled", true);
        $('#btnPausa').prop("disabled", false);
        $('#btnDetener').prop("disabled", false);
        //$('#inicio').val(new Date().toLocaleTimeString('en-US').replace(/:\d+ /, ' '));
        document.forms["frmTimer"]["inicio"].value = new Date().toLocaleTimeString('en-US').replace(/:\d+ /, ' ');
        $('#final').val(new Date().toLocaleTimeString('en-US').replace(/:\d+ /, ' '));
        $('#interrupcion').val("00:00");
        if(!inicio) {
            Clock.pause();
        }
    });
    $('#btnPausa').click(function () {
        $('#btnIniciar').prop("disabled", false);
        $('#btnPausa').prop("disabled", true);
        if(inicio) {
            Clock.start();
            inicio = false;
        }
        else {
            Clock.resume();
        }
    });
});

function ChecaForm() {
    var Inicio = $('#inicio').val();
    alert(Inicio);
    return true;
}

