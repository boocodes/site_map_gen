<?php

class Map
{
    private $pages_arr;
    private $file;
    private $map_file_type;
    private $gen_file_path;
    function __construct($pages_arr = [], $map_file_type = "json", $gen_file_path = "./")
    {
        $this->pages_arr = $pages_arr;
        $this->map_file_type = $map_file_type;
        $this->gen_file_path = $gen_file_path;
        // $this->file = fopen(__DIR__ . $this->gen_file_path, 'w');
    }

    public function generate()
    {

        switch ($this->map_file_type) {
            case "json":
                $this->json_map_generate();
                break;
            case "csv":
                $this->csv_map_generate();
                break;
            case "xml":
                $this->xml_map_generate();
                break;
        }
    }

    private function xml_map_generate() 
    {
        $map = "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\nxmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\nxsi:schemaLocation=\"https://www.sitemaps.org/schemas/sitemap/0.9\nhttp://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";
        foreach($this->pages_arr AS $first_key => $array) {
            $map .= "\n<url>\n";
            foreach($array AS $key => $value)
                 $map .= "    <" . $key . ">" . $value . "</" . $key . ">" . "\n";
            $map .= "\n</url>";
        }

        echo $map;
    }

    private function json_map_generate() 
    {
           
    }

    private function csv_map_generate() 
    {
        $map = "loc;lastmod;priority;changefreq";
    }
};
