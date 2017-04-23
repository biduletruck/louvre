var celebrationDay = [
    {
        date: '01/05/2017',
        desc: 'Fête du travail'
    },
    {
        date: '01/11/2017',
        desc: 'Toussaint'
    },
    {
        date: '25/12/2017',
        desc: 'Noël'
    }
];

$(function() {
    $(".datepicker").datepicker({
        firstDay: 1,    // Premier jour de la semaine
        minDate: 0,     // Première date disponible
        dateFormat:("dd/mm/yy"),

        beforeShowDay: function(date) {
            var day = date.getDay();
            var result = [true, "", ""];
            result = [(day !== 2)]; // retourne tous les jours sauf le mardi
            //result = $.datepicker.noWeekends(date); // si pas de weekEnd

            if (celebrationDay === null) {
                result[1] = "";
            // Indique que le mardi est le jour de fermeture
            } else 	if (  day === 2 ){
                result[0] = false;
                result[1] = "dp-highlight-coldeday";
                result[2] = "Jour de fermeture";
            } else {
                var key = $.datepicker.formatDate("dd/mm/yy", date);
                // Indique les fêtes nationale
                for (var i=0; i<celebrationDay.length; i++) {
                    if (key === celebrationDay[i].date) {
                        result[0] = false;
                        result[1] = "dp-highlight-holiday";
                        result[2] = celebrationDay[i].desc;
                    }
                }
            }
            return result;
        }
    });
});
