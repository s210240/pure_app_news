<?php

/**
 * Class NewsModel
 */
class NewsModel extends Model
{

    public $total_pages;


    /**
     * Get News
     *
     * @param $page
     * @return array
     */
    public function get_list($page)
    {
        $array_result = [];

        $connection = $this->connection;
        $result = $connection->query('SELECT * FROM news');


        $no_of_records_per_page = 5;
        $offset = ($page - 1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM news";
        $result = mysqli_query($connection, $total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $this->total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM news LIMIT $offset, $no_of_records_per_page";
        $result = mysqli_query($connection, $sql);


        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array_result, ['id' => $row['id'], 'header' => $row['header'], 'content' => $row['content']]);
        }

        $connection->close();

        return $array_result;
    }

    /**
     * @param $id
     * @return array
     */
    public function get_for_edit($id)
    {
        $array_result = [];

        $connection = $this->connection;

        $sql = sprintf("SELECT * FROM news WHERE id = %d", $id);
        $result = $connection->query($sql);

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array_result, ['id' => $row['id'], 'header' => $row['header'], 'content' => $row['content']]);
        }

        $connection->close();

        return $array_result;
    }

    /**
     * Save news
     *
     * @param $header
     * @param $content
     * @return mixed
     */
    public function store($header, $content)
    {
        $connection = $this->connection;
        $header = $connection->real_escape_string($header);
        $content = $connection->real_escape_string($content);

        $sql = sprintf("INSERT INTO NEWS (`header`, `content`) VALUES ('%s', '%s')", $header, $content);

        $connection->query($sql);

        $result = $connection->insert_id;

        return $result;
    }

    /**
     * Delete news
     *
     * @param $id
     * @return bool|mysqli_result
     */
    public function delete($id)
    {
        $connection = $this->connection;

        $sql = sprintf("DELETE FROM news WHERE id = %d ", $id);
        $result = $connection->query($sql);

        return $result;
    }


    /**
     * Update news
     *
     * @param $header
     * @param $content
     * @param $id
     * @return bool|mysqli_result
     */
    public function update($header, $content, $id)
    {
        $connection = $this->connection;

        $sql = sprintf("UPDATE news SET header = %s, content = %s WHERE id= %d ", $header, $content, $id);
        $result = $connection->query($sql);

        return $result;
    }

}