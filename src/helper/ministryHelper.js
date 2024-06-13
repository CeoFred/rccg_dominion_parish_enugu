import ministryblock from "../data/ministry/ministry.json";
import category from "../data/ministry/category.json";

// Item details
function getMinistry(id) {
    return ministryblock.filter(ministry => { return ministry.id === parseInt(id) })[0];
}
// Related item
function getItemByCategory(items, pageRoute) {
    var elems = ministryblock.filter((item) => { return parseInt(item.id) !== parseInt(pageRoute) && item.category.some(r => items.includes(r)) });
    return elems;
}
// Category
function getCategories(items) {
    var elems = category.filter((item) => {
        return items.includes(item.id)
    });
    return elems;
}
// Filter 
function getFilteredItems(items, filter = { cat: ''}) {
    var catgoryFilter = filter.cat !== undefined && filter.cat !== null && filter.cat !== '';
    // Category filter
    if (catgoryFilter) {
        items = items.filter(item => {
            return (item.category !== undefined && item.category !== null) && item.category.includes(parseInt(filter.cat))
        })
    }
    return items;
}
export { getMinistry, getFilteredItems, getCategories, getItemByCategory };