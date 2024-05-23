<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    * {
        margin: 0;
        font-family: "Poppins", sans-serif;
    }

    .footer {
        justify-content: space-between;
        align-items: center;
        background-color: #6F4E37;
        color: #fff;
        padding: 20px;
        bottom: 0;
        width: 100%;
        padding: 30px;
        display: block; /* Ensure the footer is visible */
    }

    .website-info {
        padding-top: 50px;
        display: flex;
        width: 96%;
    }

    .footer-left {
        display: flex;
        flex-direction: column;
        width: 50%;
        padding-left: 50px;
    }

    .footer-left a {
        text-decoration: none;
        color: #fff;
        margin-bottom: 10px;
    }

    .footer-right {
        padding-right: 50px;
        width: 50%;
        text-align: right;
        align-items: right;
    }

    .footer-right img {
        height: 150px;
        border-radius: 100%;
    }

    .git-links {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .github-link {
        text-decoration: none;
        font-size: 14px;
        color: #fff;
        padding: 5px 10px;
        margin: 0 10px;
        margin-top: 20px;
        display: flex;
        align-items: center;
    }

    .github-link:hover{
        color: #0969DA;
        text-decoration: underline;
    }
</style>

<footer class="footer" id="user-footer">
    <div class="website-info">
        <div class="footer-left">
            <a href="index.php">Home</a>
            <a href="product_list.php">Products</a>
            <a href="contact.php">Contact</a>
            <a href="submitFeedback.php">Feedback</a>
        </div>
        <div class="footer-right">
            <img src="logo.png" alt="Furniture Website logo">
        </div>
    </div>

    <div class="git-links">
        <a href="https://github.com/Farwah-Mahnoor" target="_blank" class="github-link">Farwah Mahnoor</a>
        <a href="https://github.com/khadija-bibi" target="_blank" class="github-link">Khadija Bibi</a>
        <a href="https://github.com/Alyankk" target="_blank" class="github-link">Muhammad Alyan</a>
        <a href="https://github.com/Konain00" target="_blank" class="github-link">Konain Raza</a>
        <a href="https://github.com/Aazeen99" target="_blank" class="github-link">Aazeen Iftikhar</a>
    </div>
</footer>