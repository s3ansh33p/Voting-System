<?php
    // 0 = 'jpg', 1 = 'png', 2 = 'use fallback'
    $imageMap = [ [ 0, 1, 0, 0, 0, 0, 0],
                  [ 0, 1, 1, 0, 1, 0, 0],
                  [ 0, 0, 0, 0, 0, 0, 0],
                  [ 0, 1, 0, 0, 1, 1, 1],
                  [], // Video
                  [1, 0, 0, 1, 1, 0, 1],
                  [], // Video
                  [] // Video
                ];

    $videoMap = [ [
        "5otYUHbaJX8",
        "wV-rGpOmJdM",
        "w9ab0_vSZs4",
        "RhVLQFQmQGM",
        "f0BZon_flpA",
        "H5PVcu93h4Q",
        "9bApszuv-oM"
    ], [
        "De0LRjD7X3c",
        "KPX8BmyT-JE",
        "dewHiIJJVsc",
        "AhNm5SLXVN4",
        "jOXSO1hJ2bc",
        "xgAJly61sDg",
        "pBORzx9Tnb8"
    ], [
        "pFDZ0QHd9gE",
        "8vtQ9WA61bI",
        "eZdD8k_bAaQ",
        "QSXowQ60UmA",
        "eNz_UTnyT0g",
        "K-P7eCd9pCg",
        "oTj14EXjuW8"

    ]
 ];

    global $imageMap, $videoMap;

    function render($cat, $id) {

        $rendered = '<button class="btn btn-danger mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-media-'.$id.'" aria-expanded="false" aria-controls="collapse-media-'.$id.'">Show/Hide Media</button><div class="collapse" id="collapse-media-'.$id.'"><div class="card card-body">';
        
        if ($GLOBALS['imageMap'][$cat-1] === []) {
            if ($cat == 5) {
                $cat = 0;
            } else if ($cat == 7) {
                $cat = 1;
            } else {
                $cat = 2;
            }
            $rendered .= '<a href="https://www.youtube.com/watch?v='.$GLOBALS["videoMap"][$cat][$id-1].'" target="_blank">https://www.youtube.com/watch?v='.$GLOBALS["videoMap"][$cat][$id-1].'</a><div class="video-container mt-2"><iframe src="https://www.youtube.com/embed/'.$GLOBALS["videoMap"][$cat][$id-1].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></div></div>';
            return $rendered;
        } else {
            $ext = 'jpg';
            if ($GLOBALS['imageMap'][$cat-1][$id-1] === 1) {
                $ext = 'png';
            }
            $rendered .= '<img style="max-height: 400px; width: fit-content; align-self: center;" src="'.SITE_URL.'/assets/'.$cat.'-'.$id.'.'.$ext.'">          
            </div>
          </div>';
          return $rendered;
        }

    }
            
?>  
