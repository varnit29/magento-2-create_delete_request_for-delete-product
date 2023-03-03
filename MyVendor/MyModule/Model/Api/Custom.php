<?php namespace MyVendor\MyModule\Model\Api;

use MyVendor\MyModule\Api\CustomInterface;
// use MyVendor\MyModule\Model\ModuleFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Catalog\Api\ProductRepositoryInterface;
class Custom implements CustomInterface
{
    private $moduleFactory;
    private $quote;
    protected $response = ['success' => false];

    public function __construct(CollectionFactory $moduleFactory,
        \Magento\Quote\Model\Quote $quote,
        ProductRepositoryInterface $productRepository)
    {
        $this->quote = $quote;
        $this->moduleFactory = $moduleFactory;
        $this->productRepository = $productRepository;
    }

    /** * @return string */
    public function getData()
    {
        try {
            $data = $this->moduleFactory->create();
            $data->addAttributeToSelect('*');
            $length = $data->count();
            // $data->setPageSize(3);
            foreach ($data as $product)
            {
               $array[]=[
                "code" => "200",
                "name" => $product->getName(),
                "id" => $product->getId(),
                "sku" => $product->getSku()
                ];
            }
            return $array;
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /** * @param int $id * @return string true on success */
    public function getDelete($id)
    {
        try {
            if ($id) {
                // return $id;
                // $productI=$this->productRepository->create();
                $productI = $this->productRepository->getById($id);
                $this->productRepository->delete($productI);
                return "success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "failed";
    }
}
?>