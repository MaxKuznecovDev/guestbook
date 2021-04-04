<?php


namespace core\mvc;
use core\Page;

class View
{
    /**
     * render
     *
     * Returns content for the user
     * @param Page $page
     * @return  string
     *
     */
    public function render(Page $page){
        return $this->renderLayout($page, $this->renderView($page));
    }

    /**
     * messageOutput
     *
     * Outputs messages to the user from the server
     * @param array $arrMessage
     * @return void
     */
    public static function messageOutput($arrMessage){
        $message = "";
        foreach ($arrMessage as $resultValid) {
            if (is_string($resultValid)) {
                $message .= '<div class="info alert alert-info">' . $resultValid . '</div>';
            }
        }
        echo $message;
    }

    /**
     * renderLayout
     *
     * Returns the main content plus layout for the user
     * @param Page $page
     * @param string $content  The main content
     * @return  string
     *
     */
    private function renderLayout(Page $page,$content){
        ob_start();
        $title = $page->title;
        require_once LAYOUTS.$page->layout.".php";
        return ob_get_clean();
    }

    /**
     * renderView
     *
     * Returns the main content for the user
     * @param Page $page
     * @return  string
     *
     */
    private function  renderView(Page $page){
        ob_start();
        if($page->data){
            $data=$page->data;
            extract($data);
        }

        require_once VIEWS.$page->view."View.php";
        return ob_get_clean();
    }
}