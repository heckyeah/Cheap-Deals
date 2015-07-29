<div class="row">
      <div class="columns">
        <!-- Latest deal containers -->
        <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
		<h1>Search Results</h1>
        <?php

        	$result = $this->model->search();
	        // If there are no results
	        if ( $result->num_rows == 0 ) {

	        	echo '<h3>No results</h3>';

	      	} else {
				// Loop through each result and display inside a list item
				while( $row = $this->searchResults->fetch_assoc() ) {
					echo '<li>';
					echo '<a href="index.php?page=deal&dealid='.$row['id'].'" ><img src="'.$row['image'].'"></a>';
					echo '<h3><a href="index.php?page=deal'.$row['id'].'" >'.$row['name'].'</a></h3>';
					echo '<p>'.$row['description'].'</p>';
					echo '</li>';
				}      		
	      	}

        ?>

        </ul>
      </div>
    </div>