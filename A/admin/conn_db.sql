SELECT st_id, COUNT(*)
FROM students
GROUP BY st_id
HAVING COUNT(*) > 1;