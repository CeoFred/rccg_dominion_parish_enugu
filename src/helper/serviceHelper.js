import serviceblock from '../data/service/service.json';

// Service details
function getService(id) {
    return serviceblock.filter(service => { return service.id === parseInt(id) })[0];
}
export { getService };