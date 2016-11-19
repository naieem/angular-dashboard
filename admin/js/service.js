app.factory('Articles', Articles);
Articles.$inject = ['$resource'];

function Articles($resource) {
    return $resource('./db.php', {}, {
        query: {
            method: "GET",
            isArray: true
        },
        create: {
            method: "POST"
        },
        get: {
            method: "GET"
        },
        remove: {
            method: "POST"
        },
        update: {
            method: "PUT"
        }
    });
}
