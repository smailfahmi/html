<?
function get($recurso)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function post($recurso, $array)
{
    $array = json_encode($array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-length: ' . strlen($array)));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code != 201) {
        echo 'no se a podido insertar';
    }
    curl_close($ch);
    return $response;
}

function put($recurso, $array)
{
    $array = json_encode($array);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso . '/' . $_REQUEST['id']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-length: ' . strlen($array)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code != 201) {
        echo 'no se a podido insertar';
    }
    curl_close($ch);
    return $response;
}



function delete($recurso)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso . '/' . $_REQUEST['id']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code != 201) {
        echo 'no se a podido BORRAR';
    }
    curl_close($ch);
    return $response;
}