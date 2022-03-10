window.onload = () => {
    let calendarElt = document.querySelector("#calendrier")
    let calendar = new FullCalendar.Calendar(calendarElt, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        events: data,
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek',


        },


        editable: true,
        eventsResizableFormStart: true
    })

    calendar.on('eventChange', (e) => {
        let url = `/api/${e.event.id
            }/edit`
        let donnees = {
            "title": e.event.title,
            "description": e.event.extendedProps.description,
            "start": e.event.start,
            "end": e.event.end,
            "backgroundColor": e.event.color_event,
            "allDay": e.event.allDay
        }

        let xhr = new XMLHttpRequest
        xhr.open("PUT", url)
        xhr.send(JSON.stringify(donnees))
    })
    calendar.render()
}