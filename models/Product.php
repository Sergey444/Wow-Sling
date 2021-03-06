<?php

//
//
class Product
{
    const SHOW_BY_DEFAULT = 8;

    /**
    * Returns an array of products
    */
    public static function getLatestProducts($const = self::SHOW_BY_DEFAULT)
    {
        $count = intval($const);

        $db = Db::getConnection();

        $productsList = array();

        // $result = $db->query('SELECT*FROM backpack WHERE availability = 1 ORDER BY id DESC  LIMIT '.$count );
        $result = $db->query('(SELECT * FROM `backpack` WHERE availability > 0 AND category_id = 0 ORDER BY id DESC LIMIT 2) UNION
                              (SELECT * FROM `backpack` WHERE availability > 0 AND category_id = 2 ORDER BY id DESC LIMIT 3) UNION
                              (SELECT * FROM `backpack` WHERE availability > 0 AND category_id = 1 ORDER BY id DESC LIMIT 3)');

        $i = 0;
        while($row = $result->fetch_assoc()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['description'] = $row['description'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['category_id'] = Category::getCategory($row['category_id']);
            $i++;
        }

        return $productsList;
    }


    public static function getHitsProducts()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT*FROM backpack WHERE is_hit = 1 ORDER BY id DESC  LIMIT 4' );

        $i = 0;
        while($row = $result->fetch_assoc()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['description'] = $row['description'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['category_id'] = Category::getCategory($row['category_id']);
            $i++;
        }
        return $productsList;
    }

    public static function getCatalogProduct($param = false, $page = 1)
    {


        switch ($param) {
            case 'ergorukzak':
                $param = 0;
                break;
            case 'mysling':
                $param = 1;
                break;
            case 'bantik':
                $param = 2;
                break;
            // case 'cocon':
            //     $param = 3;
        }

            //$param = intval($param);
            $page = intval($page);
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $productsList = array();
            
            //$result = $db->query('SELECT*FROM backpack WHERE id > 0 AND category_id = '.$param.' ORDER BY availability DESC LIMIT '.self::SHOW_BY_DEFAULT.' OFFSET '.$offset.'');


            $result = $db->prepare('SELECT*FROM backpack WHERE id > 0 AND category_id = ? ORDER BY availability DESC  LIMIT '.self::SHOW_BY_DEFAULT.' OFFSET ? ');
            $result->bind_param('ii', $param, $offset);
            $result->execute();
            $result = $result->get_result();

            $i = 0;
            while($row = $result->fetch_assoc()) {
                $productsList[$i]['id'] = $row['id'];
                $productsList[$i]['name'] = $row['name'];
                $productsList[$i]['description'] = $row['description'];
                //$productsList[$i]['img'] = $row['img'];
                $productsList[$i]['availability'] = $row['availability'];
                $productsList[$i]['price'] = $row['price'];
                $productsList[$i]['category_id'] = $row['category_id'];
                $i++;
            }

            return $productsList;
        }


    public static function getOneProduct($id)
    {

        $id = intval($id);

        $db = Db::getConnection();

        $productItem = array();


        //$result = $db->query('SELECT*FROM backpack WHERE id = '.$id.'');

        $result = $db->prepare('SELECT*FROM backpack WHERE id = ?');
        $result->bind_param('i', $id);
        $result->execute();
        $result = $result->get_result();

        $productItem = $result->fetch_assoc();

        return $productItem;
    }

    public static function getTotalProductsInCatalog($param)
    {
        switch ($param) {
            case 'ergorukzak':
                $param = 0;
                break;
            case 'mysling':
                $param = 1;
                break;
            case 'bantik':
                $param = 2;
                break;
            // case 'cocon':
            //     $param = 3;
        }

        $param = intval($param);

        $db = Db::getConnection();

        //$result = $db->query('SELECT count(id) AS count FROM backpack WHERE id > 0 AND category_id = '.$param.'');

        $result = $db->prepare('SELECT count(id) AS count FROM backpack WHERE id > 0 AND category_id = ?');
        $result->bind_param('s', $param);
        $result->execute();
        $result = $result->get_result();
        $row = $result->fetch_assoc();

        return $row['count'];
    }

    public static function getCountProduct()
    {
        $db = Db::getConnection();
        $result = $db->query('SELECT count(id) AS count FROM backpack WHERE id > 0 ')->fetch_assoc();

        return $result;
    }

    public static function getProductsByIds($idsArray)
    {
        $products = array();

        $db = Db::getConnection();


        $idsString = implode(',', $idsArray);

        $idsString = htmlspecialchars($idsString);

        $sql = "SELECT * FROM backpack WHERE id IN ($idsString)";
        $result = $db->query($sql);

//        $result= $db->prepare("SELECT * FROM backpack WHERE id IN (?)");
//        $result->bind_param('s', $idsString);
//        $result->execute();
//        $result = $result->get_result();


        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $products[$i]['id'] = $row['id'];
            //$products[$i]['img'] = $row['img'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }

    public static function getProductsList($category)
    {
        $db = Db::getConnection();

        //Получение и возврат результатов
        if ( $category === false ) {
            $result = $db->query('SELECT * FROM backpack  ORDER BY id  DESC ');

        } else {
            $result = $db->query('SELECT * FROM backpack WHERE category_id = "'.$category.'" ORDER BY id  DESC ');

        }
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['category_id'] = $row['category_id'];
            $i++;
        }
        return $productsList;
    }


    /**
     * Удаляет товар с указанным id из БД
     * @param integer $id <p>id товара</p>
     * $return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteProductById($id)
    {
        //Соединение с базой данных
        $db = Db::getConnection();

        $id = intval($id);
        //Текст запроса к базе данных
        //$result = $db->query('DELETE FROM backpack WHERE id = '.$id);

        $result = $db->prepare('DELETE FROM backpack WHERE id = ?');
        $result->bind_param('i', $id);
        $result->execute();

        return $result;
    }

    /**
     * Добавляет новый товар
     * @param aarray $options <p>Массив с информацией о товаре</p>
     * @return int
     */
    public static function createProduct($options)
    {
        //Соединение с БД
        $db = Db::getConnection();

        $name = htmlspecialchars($options['name']);
        $description = htmlspecialchars($options['description']);
        $price = htmlspecialchars($options['price']);
        $availability = htmlspecialchars($options['availability']);
        $category_id = htmlspecialchars($options['category_id']);
        $is_hit = intval($options['is_hit']);
        //Текст запроса к БД
//        $sql = $db->query('INSERT INTO backpack ( name, description, price, availability, category_id) VALUES ( "'.$options['name'].'",'
//                . ' "'.$options['description'].'", '.$options['price'].', '.$options['availability'].', '.$options['category_id'].')');
        $sql = $db->prepare('INSERT INTO backpack ( name, description, price, availability, category_id, is_hit) VALUES ( ?, ?, ?, ?, ?, ?)');
        $sql->bind_param('ssiiii', $name, $description, $price, $availability, $category_id, $is_hit );
        $sql->execute();
    //    $sql = $sql->get_result();
        //если запрос выполнен успешно возвращает id добавленной записи

        if ($sql) {
            $result = $db->query('SELECT id FROM backpack ORDER BY id DESC LIMIT 1');
            return $result->fetch_assoc();
        }

        return 0;
    }

    /**
     * Редактирует товар с заданным id
     * @param type $id <p>Id товара</p>
     * @param type $options <p>Массив с информацией о товаре</p>
     * @return type
     */
    public static function updateProductById($id, $options)
    {
        //Соединение с базой данных
        $db = Db::getConnection();

        $id = intval($id);
        $name = htmlspecialchars($options['name']);
        $description = htmlspecialchars($options['description']);
        $price = htmlspecialchars($options['price']);
        $availability = htmlspecialchars($options['availability']);
        $category_id = htmlspecialchars($options['category_id']);
        $is_hit = intval($options['is_hit']);


        //Текст запроса к БД
//        $result = $db->query('UPDATE backpack SET  name="'.$name.'", description="'.$description.'", price="'.$price.'", availability="'.$availability.'",'
//                . 'category_id="'.$category_id.'" WHERE id ='.$id);

        $result = $db->prepare('UPDATE backpack SET  name= ? , description= ? , price= ?, availability= ? , category_id= ?, is_hit = ?  WHERE id = ? ');
        $result->bind_param('ssiiiii', $name, $description, $price, $availability, $category_id, $is_hit, $id);
        $result->execute();

        return $result;
    }

    public static function getImage($id)
    {

        //Название изображения пустышки
        $noImage = 'no-image.jpg';

        //Путь к папке с товарами
        $path = '/template/catalog/';

        //Путь к изображению товара
        $pathToProductImage = $path.$id.'.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            //Если изображение для товара существует
            //Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        //Возвращаем путь изображения пустышки
        return $path . $noImage;
    }
}
