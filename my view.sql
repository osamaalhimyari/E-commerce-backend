CREATE OR REPLACE VIEW  item1view AS
SELECT items.* , categories.* FROM item 
INNER JOIN  categories on  items.item_cat = categories.categories_id ; 



CREATE OR REPLACE VIEW myfavorite AS
SELECT favorite.* , items.* , user.user_id FROM favorite 
INNER JOIN user ON user.user_id  = favorite.favorite_userid
INNER JOIN items ON items.item_id  = favorite.favorite_itemid


-- changed
CREATE or REPLACE VIEW cartview as 
SELECT SUM(items.item_price - items.item_price * item_discount / 100) as totalprice  , COUNT(cart.cart_itemid) as itemscount , cart.* , items.* FROM cart 
INNER JOIN items ON items.item_id = cart.cart_itemid
WHERE cart_orderid = 0 
GROUP BY cart.cart_itemid , cart.cart_userid , cart.cart_orderid ;
-- //////

CREATE  or REPLACE view orderview AS 
SELECT order.* , address.* FROM order 
LEFT JOIN address ON address.address_id = order.order_address ; 


CREATE or REPLACE VIEW orderdetailsview  as 
SELECT SUM(items.item_price - items.item_price * item_discount / 100) as itemprice  , COUNT(cart.cart_itemid) as countitem , cart.* , items.*   FROM cart 
INNER JOIN items ON items.item_id = cart.cart_itemid 
WHERE cart_order != 0 
GROUP BY cart.cart_itemid , cart.cart_userid , cart.cart_order ;


CREATE or REPLACE VIEW itemtopselling AS 
SELECT COUNT(cart_id) as countitems , cart.* , items.*  , (item_price - (item_price * item_discount / 100 ))  as itempricedisount  FROM cart 
INNER JOIN items ON items.item_id = cart.cart_itemid
WHERE cart_order != 0 
GROUP by cart_itemid   ; 



 
 


 
 



 

 