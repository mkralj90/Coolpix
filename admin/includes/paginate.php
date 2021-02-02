    <?php



    class Paginate{

    public $current_page;
    public $item_per_page;
    public $item_total_count;
    


    public function __construct($page=1, $item_per_page= 10, $item_total_count=0){

    $this->current_page = (int)$page;
    $this->item_per_page = (int)$item_per_page;
    $this->item_total_count = (int)$item_total_count;

    } // end of __construct
    /* ---------------------------------------------------------------------------- */
    
    public function number_per_page(){

    

    } // end of // end of
    /* ---------------------------------------------------------------------------- */

    public function next(){

    return $this->current_page + 1;


    } // end of next
    /* ---------------------------------------------------------------------------- */


    public function previous(){

    return $this->current_page - 1;
        
        
    } // end of previous
    /* ---------------------------------------------------------------------------- */



    public function page_total(){

    return ceil($this->item_total_count/$this->item_per_page); 


    } // end of page_total
    /* ---------------------------------------------------------------------------- */



    public function has_previous(){

    return $this->previous() >= 1 ? true : false;

    } // end of has_previous
    /* ---------------------------------------------------------------------------- */


    public function has_next(){

    return $this->next() <= $this->page_total() ? true : false;

    } // end of has_previous
    /* ---------------------------------------------------------------------------- */


    public function offset(){

    return ($this->current_page -1) * $this->item_per_page;

    } // end of offset
    /* ---------------------------------------------------------------------------- */


    } // end of class Paginate
    ?>