module.exports = function () {

var BOLD_START = "[b]";
var BOLD_END = "[/b]";
var ITALIC_START = "[i]";
var ITALIC_END = "[/i]";
var UNDERLINE_START = "[u]";
var UNDERLINE_END = "[/u]";
var DELETE_START = "[del]";
var DELETE_END = "[/del]";
var URL_START = "[url=";
var URL_END = "[/url]";
var IMG_START = "[img]";
var IMG_END = "[/img]";
var LIST_START = "[list]";
var LIST_END = "[/list]";
var LI_START = "[*]";

var URL_TAG_TYPE = "URL";
var LIST_TAG_TYPE = "LIST";

var TEXT_AREA_ID = "text-area_content";


$("[name='add-bold']").click(function(){ insertTag(BOLD_START, BOLD_END, TEXT_AREA_ID); });

$("[name='add-italic']").click(function(){ insertTag(ITALIC_START, ITALIC_END, TEXT_AREA_ID); });

$("[name='add-underline']").click(function(){ insertTag(UNDERLINE_START, UNDERLINE_END, TEXT_AREA_ID); });

$("[name='add-delete']").click(function(){ insertTag(DELETE_START, DELETE_END, TEXT_AREA_ID); });

$("[name='add-url']").click(function(){ insertTag(URL_START, URL_END, TEXT_AREA_ID, URL_TAG_TYPE); });

$("[name='add-img']").click(function(){ insertTag(IMG_START, IMG_END, TEXT_AREA_ID); });

$("[name='add-list']").click(function(){ insertTag(LIST_START, LIST_END, TEXT_AREA_ID, LIST_TAG_TYPE); });



function insertTag(startTag, endTag, textareaId, tagType)
{
    var field  = document.getElementById(textareaId);
    var scroll = field.scrollTop;
    field.focus();

    /* === Partie 1 : on récupère la sélection === */
    if (window.ActiveXObject)
    {
        var textRange = document.selection.createRange();
        var currentSelection = textRange.text;
    }
    else
    {
        var startSelection   = field.value.substring(0, field.selectionStart);
        var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
        var endSelection     = field.value.substring(field.selectionEnd);
    }

    /* === Partie 2 : on analyse le tagType === */
    if (tagType)
    {
        switch (tagType)
        {
            case URL_TAG_TYPE:

                endTag = URL_END;
                if (currentSelection)
                {
                    // Il y a une sélection
                    if (currentSelection.indexOf("http://") == 0 || currentSelection.indexOf("https://") == 0 || currentSelection.indexOf("ftp://") == 0 || currentSelection.indexOf("www.") == 0)
                    {
                        // La sélection semble être un lien. On demande alors le libellé
                        var label = prompt("Quel est le libellé du lien ?") || "";
                        startTag = URL_START + currentSelection + "]";
                        currentSelection = label;
                    }
                    else
                    {
                        // La sélection n'est pas un lien, donc c'est le libelle. On demande alors l'URL
                        var URL = prompt("Quelle est l'url ?");
                        startTag = URL_START + URL + "]";
                    }
                }
                else
                {
                    // Pas de sélection, donc on demande l'URL et le libelle
                    var URL = prompt("Quelle est l'url ?") || "";
                    var label = prompt("Quel est le libellé du lien ?") || "";
                    startTag = URL_START + URL + "]";
                    currentSelection = label;
                }
                break;

            case LIST_TAG_TYPE:

                endTag = LIST_END;
                if (currentSelection)
                {
                    startTag = LIST_START + "\n" + LI_START;

                    var str = currentSelection;
                    var txt = str.replace(/\n/g, "\n" + LI_START);
                    currentSelection = txt;

                    endTag = "\n" + LIST_END;
                }
                else
                {
                    startTag = LIST_START + "\n" + LI_START + "Premier élément\n" + LI_START + "Deuxième élément\n";
                }
                break;
        }
    }

    /* === Partie 3 : on insère le tout === */
    if (window.ActiveXObject)
    {
        textRange.text = startTag + currentSelection + endTag;
        textRange.moveStart("character", -endTag.length - currentSelection.length);
        textRange.moveEnd("character", -endTag.length);
        textRange.select();
    }
    else
    {
        field.value = startSelection + startTag + currentSelection + endTag + endSelection;
        field.focus();
        field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);
    }

    field.scrollTop = scroll;
}

};