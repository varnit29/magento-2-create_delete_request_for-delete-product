<?php

namespace MyVendor\MyModule\Api;


interface CustomInterface
{

    /**
     * @return string
     */
    public function getData();

    /**
     * @param int $id
     * @return string true on success
     */
    public function getDelete($id);

}
?>