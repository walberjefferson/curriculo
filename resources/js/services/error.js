const ERROR_422 = (response) => {
    let {data, status} = response;
    let {errors} = data;
    const allErrors = {};
    Object.keys(errors).map((key) => {
        allErrors[key] = errors[key][0];
    })
    return allErrors;
}

const ERROR_403 = (response) => {
    let {data, status} = response;
    let {error} = data;
}

export {ERROR_422, ERROR_403}
