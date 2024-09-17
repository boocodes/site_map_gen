<?php

class Map
{
    private $pages_arr;
    private $map;
    private $map_file_type;
    private $gen_file_path;
    function __construct($pages_arr = [], $map_file_type = "json", $gen_file_path = "./")
    {
        $this->pages_arr = $pages_arr;
        $this->map_file_type = $map_file_type;
        $this->gen_file_path = $gen_file_path;
        
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
        $file = file_put_contents($this->gen_file_path . "/sitemap." . $this->map_file_type, $this->map);
    }

    private function xml_map_generate() 
    {
        $this->map = "<urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\nxmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\nxsi:schemaLocation=\"https://www.sitemaps.org/schemas/sitemap/0.9\nhttp://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">";
        foreach($this->pages_arr AS $first_key => $array) {
            $this->map .= "\n<url>\n";
            foreach($array AS $key => $value)
                 $this->map .= "    <" . $key . ">" . $value . "</" . $key . ">" . "\n";
            $this->map .= "\n</url>";
        }
    }

    private function json_map_generate() 
    {
        $this->map = json_encode($this->pages_arr);
    }

    private function csv_map_generate() 
    {
        $this->map = "loc;lastmod;priority;changefreq";
        foreach($this->pages_arr AS $first_key => $array) {
            $this->map .= "\n";
            foreach($array AS $key => $value)
                 $this->map .= $value . ";";
            $this->map = substr($this->map, 0, -1);
        } 
    }
};
