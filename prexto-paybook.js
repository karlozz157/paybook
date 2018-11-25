const request = (endpoint, method='GET', data={}) => {
    let options = {      
        method: method,
        headers:{
            'Content-Type': 'application/json'
        }
    };

    if (method !== 'GET') {
        options['body'] = JSON.stringify(data);
    }

    return fetch(`api.php${endpoint}`, options);
};

const User = (() => {
    const find = async () => {
        let response = await request('/users');

        return response.json();
    };

    const findOne = async (name) => {
        let response = await request(`/users/${name}`);

        return response.json();
    };

    const create = async (name) => {
        let response = await request('/users', 'POST', {
            'name': name
        });

        return response.json();
    };

    const remove = async (name) => {
        let response = await request(`/users/${name}`, 'DELETE');

        return response.json();
    };

    return {
        find: find,
        findOne: findOne,
        create: create,
        remove: remove
    };
}) ();


const Session = (() => {
    const create = async (name) => {
        let response = await request('/session', 'POST', {
            'name': name
        });

        return response.json();
    };

    return {
        create: create
    };
}) ();

const Credential = (() => {
    const find = async (name) => {
        let response = await request(`/credentials/${name}`);

        return response.json();
    };

    const findOne = async (name, idCredential) => {
        let response = await request(`/credentials/${name}/${idCredential}`);

        return response.json();
    };

    return {
        find: find,
        findOne: findOne
    };
}) ();

const Transaction = (() => {
    const find = async (name, idCredential) => {
        let response = await request(`/transactions/${name}/${idCredential}`);

        return response.json();
    };

    return {
        find: find
    };
}) ();
