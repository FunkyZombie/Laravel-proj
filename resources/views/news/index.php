 <div class="container news" >
    <?php foreach($news as $key => $new): ?>
    
            <div class="news-item">
                <a href="/news/<?=(++$key)?>"><h2><?=$new['title']?></h2></a>
                <p><?=$new['author']?> - <?=$new['created_at']->format('d-m-Y H:i')?></p>
                <p><?=$new['description']?></p>
            </div>
        
    <?php endforeach; ?>
</div>




