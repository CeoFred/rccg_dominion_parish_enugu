import sermonblock from "../data/sermon/sermon.json";

// Item details
function getSermon(id) {
    return sermonblock.filter(sermon => { return sermon.id === parseInt(id) })[0];
}
// Recent Sermon
function changeToMonth(month) {
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return months[month];
}
function setDemoDate() {
    var today = new Date();
    sermonblock.slice(0, 3).map(item => {
        item.timestamp = today.getTime() - (3 * 24 * 60 * 60 * 1000);
        // Remove this date on your live demo. This is only used for preview purposed. Your date should actually be updated
        // in the sermon.json object
        item.sermondate = `${changeToMonth(today.getMonth())} ${today.getDate()}, ${today.getFullYear()}`;
        return item;
    });
}
function getNextSermon() {
    var elems = sermonblock.filter(item => {
        return item.timestamp < new Date(item.sermondate);
    });
    return elems;
}
setDemoDate();
// Filter 
function getFilteredItems(items, filter = { author: '' }) {
    var authorFilter = filter.author !== undefined && filter.author !== null && filter.author !== '';
    // Author filter
    if (authorFilter) {
        items = items.filter(item => {
            return (item.author !== undefined && item.author !== null) && item.author.includes(parseInt(filter.author))
        })
    }
    return items;
}
export { getSermon, getFilteredItems, getNextSermon };