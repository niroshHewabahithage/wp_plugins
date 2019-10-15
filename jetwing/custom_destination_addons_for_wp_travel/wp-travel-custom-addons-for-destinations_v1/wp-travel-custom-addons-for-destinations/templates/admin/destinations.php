<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <h2>All Destination Lists</h2>
            <p>pick a one destination and edit its custom addons</p>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Destination Name</th>
                                <th scope="col">Destination Slug</th>
                                <!--<th scope="col">Taxonomy</th>-->
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $x = 0;
                            if (isset($destinations) && !empty($destinations) && $destinations != "" && $destinations != null) {
                                foreach ($destinations as $d) {
                                    $x++;
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $x; ?></th>
                                        <td><?php echo $d->name; ?></td>
                                        <td><?php echo $d->slug; ?></td>
                                        <!--<td><?php echo $d->taxonomy; ?></td>-->
                                        <td>
                                            <form class="form_items">
                                                <input type="hidden" class="destination" name="destination" value="<?php echo $d->name; ?>">
                                            <input type="hidden" class="destination_slug" name="destination_slug" value="<?php echo $d->slug; ?>">
                                            </form>
                                            <button class="btn btn-sm btn-info edit_items" type="button">Edit</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <?php
            include 'load_edit_destination.php';
            ?>
        </div>
    </div>