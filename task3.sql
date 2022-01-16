SELECT models.name ,COUNT(*) AS 'count' FROM cars,models WHERE cars.model_id = models.id GROUP BY models.name;

SELECT * FROM cars WHERE model_id NOT IN (SELECT id FROM models);

SELECT models.name, SUM(price) AS 'sum_price' FROM cars, models WHERE cars.model_id = models.id AND cars.price > 10  GROUP BY models.name HAVING SUM(price) > 60