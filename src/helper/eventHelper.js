import eventblock from "../data/event/event.json";

// Item details
function getEvent(id) {
    return eventblock.filter(event => { return event.id === parseInt(id) })[0];
}
// Recent Event
function changeToMonth(month) {
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return months[month];
}
function setDemoDate() {
    var today = new Date();
    eventblock.slice(0, 3).map(item => {
        item.timestamp = today.getTime() - (3 * 24 * 60 * 60 * 1000);
        // Remove this date on your live demo. This is only used for preview purposed. Your date should actually be updated
        // in the event.json object
        item.eventdate = `${today.getDate()} ${changeToMonth(today.getMonth())}, ${today.getFullYear()}`;
        return item;
    });
}
function getNextEvent() {
    var elems = eventblock.filter(item => {
        return item.timestamp < new Date(item.eventdate);
    });
    return elems;
}
setDemoDate();
// Get Date
function getDateInitials(string) {
    var names = string.split(' '),
        initials = '<span>' + names[0].substring(0, 2) + '</span>';

    if (names.length > 2) {
        initials += names[names.length - 2].substring(0, 3).toUpperCase() + "'21";
    }
    return initials;
}
// Filter 
function getFilteredItems(items, filter = { tag: '', speaker: '' }) {
    var tagFilter = filter.tag !== undefined && filter.tag !== null && filter.tag !== '';
    var speakerFilter = filter.speaker !== undefined && filter.speaker !== null && filter.speaker !== '';
    // Tag filter
    if (tagFilter) {
        items = items.filter(item => {
            return (item.tags !== undefined && item.tags !== null) && item.tags.includes(parseInt(filter.tag))
        })
    }
    // Speaker filter
    if (speakerFilter) {
        items = items.filter(item => {
            return (item.speaker !== undefined && item.speaker !== null) && item.speaker.includes(parseInt(filter.speaker))
        })
    }
    return items;
}
export { getEvent, getFilteredItems, getNextEvent, getDateInitials };