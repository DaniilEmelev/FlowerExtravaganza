<?php

class Cart
{
    private $cartData;

    public function __construct()
    {
        session_start();
        if (!isset ($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $this->cartData = &$_SESSION['cart'];
    }

    public function addToCart($productData)
    {
        array_push($this->cartData, $productData);
        return true;
    }

    public function removeFromCart($index)
    {
        if (isset ($this->cartData[$index])) {
            unset($this->cartData[$index]);
            $this->cartData = array_values($this->cartData);
            return true;
        }
        return false;
    }

    public function updateTotalAmount($totalAmount)
    {
        $_SESSION['total_amount'] = $totalAmount;
        return true;
    }

    public function updateImage($index, $image)
    {
        if (isset ($this->cartData[$index])) {
            $this->cartData[$index]['image'] = $image;
            return true;
        }
        return false;
    }

    public function processRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset ($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        if (isset ($_POST['productData'])) {
                            $productData = $_POST['productData'];
                            return $this->addToCart($productData);
                        }
                        break;
                    case 'remove':
                        if (isset ($_POST['index'])) {
                            $index = $_POST['index'];
                            return $this->removeFromCart($index);
                        }
                        break;
                    case 'update_total_amount':
                        if (isset ($_POST['totalAmount'])) {
                            $totalAmount = $_POST['totalAmount'];
                            return $this->updateTotalAmount($totalAmount);
                        }
                        break;
                    case 'update_image':
                        if (isset ($_POST['index']) && isset ($_POST['image'])) {
                            $index = $_POST['index'];
                            $image = $_POST['image'];
                            return $this->updateImage($index, $image);
                        }
                        break;
                    default:
                        return false;
                }
            }
        }
        return false;
    }
}

$cart = new Cart();
$cart->processRequest();

