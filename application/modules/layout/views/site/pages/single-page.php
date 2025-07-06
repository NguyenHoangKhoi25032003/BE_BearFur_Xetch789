<article>
    <section>
        <div class="box-wapper-introduce">
            <div class="container">
                <div class="block-wapper--title">
                    <h2><?php echo isset($row['title']) ? $row['title'] : ''; ?></h2>
                </div>
                <div class="block-wapper-introduce--content">
                    <?php echo isset($row['bodyhtml']) ? filter_content($row['bodyhtml']) : ''; ?>
                </div>
            </div>
        </div>
    </section>
</article>