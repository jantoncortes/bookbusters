$(document).ready(
    function(){
    
        $.post(
            "./php/favoritos.php",
            {},
            function(out){
                var arr = out.split("@");
                var len = arr.length;
                for(i=0;i<=len;i++)
                {
                    console.debug(out);
                    $("i#"+arr[i]).attr("class","fa-solid fa-heart");
                }

            }
        );
    }
);

function addFavCor(c)
{
    $.post(
        "./php/addfavcor.php",
        {cod : c},
        function(out){
            if (out == "Añadido a favoritos")
            {
                $("i#"+c).attr("class","fa-solid fa-heart");
            }
            else
            {
                $("i#"+c).attr("class","fa-regular fa-heart");
            }
            
        }
    );
}

function addFavBut(c)
{
    $.post(
        "./php/addfavbut.php",
        {cod : c},
        function(out)
        {
            
            if (out == "Añadido a favoritos")
            {
                $("i#"+c).attr("class","fa-solid fa-heart");
            }
            else
            {
            }
            
        }
    );
}

function hover_cor_in(c)
{
    $("i#"+c).css("font-size","50px")
    $("i#"+c).css("color","#b20101")
}
function hover_cor_out(c)
{
    $("i#"+c).css("font-size","40px")
    $("i#"+c).css("color","#f56a6a")
}