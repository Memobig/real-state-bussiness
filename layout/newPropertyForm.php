<div class="row centered-form center-block">
	<div class="container col-md-8 col-md-offset-1">
		<div class="card border-primary text-center" style="">
			<div class="card-header"><?=$title?></div>
				<div class="card-body">
					<form action="controller.php" method="post">
					    <div class="form-group row">
					        <label class="col-sm-3 col-form-label">Location</label>
					        <div class="col-sm-8">
					            <input type="text" class="form-control" name="location" value="<?=$property->getLocation()? $property->getLocation() : '' ?>" />
					            <small class="form-text text-danger"></small>
					        </div>
					    </div>

					    <div class="form-group row">
					        <label class="col-sm-3 col-form-label">Description</label>
					        <div class="col-sm-8">
					            <input type="text" class="form-control" name="description"  value="<?=$property->getDescription()? $property->getDescription() : '' ?>"/>
					            <small class="form-text text-danger"></small>
					        </div>
					    </div>

					    <div class="form-group row">
					        <label class="col-sm-3 col-form-label">Price</label>
					        <div class="col-sm-8">
					            <input type="number" class="form-control" name="price"  value="<?=$property->getPrice()? $property->getPrice() : '' ?>"/>
					            <small class="form-text text-danger"></small>
					        </div>
					    </div>

					    <div class="form-group row">
					        <label class="col-sm-3 col-form-label">Type</label>
					        <div class="col-sm-8">
									<select name="type" class="form-control">
									  <option value="0" <?=$property->getType() == 0 ? 'selected':''?>>SALE</option>
									  <option value="1" <?=$property->getType() == 1 ? 'selected':''?>>RENT</option>
									</select>
					        </div>
					    </div>
					    <?php if(!$propertyId == 0) {?>
						<input type="hidden" class="form-control" name="id" value="<?=$propertyId?>" />
						<?php } ?>
					    <div class="form-group row">
					        <div class="col-sm-9">
					            <input type="submit" value="<?=$currentPage?>" class="btn btn-primary" />
					        </div>
					    </div>
					</form>
				</div>
			</div>
	</div>
</div>