import volunteerblock from '../data/volunteer/volunteer.json';

// Volunteer details
function getVolunteer(id) {
    return volunteerblock.filter(volunteer => { return volunteer.id === parseInt(id) })[0];
}
export { getVolunteer };