let textarea        = <HTMLInputElement>document.getElementById("blogEntry");
let title           = <HTMLInputElement>document.getElementById("title");
let shorttitle      = <HTMLInputElement>document.getElementById("shorttitle");
let textlengthinput = <HTMLInputElement>document.getElementById("textlength");
let blogDesc        = <HTMLInputElement>document.getElementById("blogDesc");
let author          = <HTMLInputElement>document.getElementById("author");
let date            = <HTMLInputElement>document.getElementById("date");

textlengthinput.value = date.value.length + " Bytes";

textarea.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});

title.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});

shorttitle.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});

blogDesc.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});

author.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});

date.addEventListener("input", function()
{
    let total: number = getTotalLength();
    setTotalLength(total);
});


function getTotalLength(): number
{
    let textLength: number       = textarea.value.length;
    let titleLength: number      = title.value.length;
    let shortTitleLength: number = shorttitle.value.length;
    let blogDescLength: number   = blogDesc.value.length;
    let authorLength: number     = author.value.length;
    let dateLength: number       = date.value.length;


    return textLength + titleLength + shortTitleLength + blogDescLength + authorLength + dateLength;
}

function setTotalLength(length: number): void
{
    textlengthinput.value = length + " Bytes";
}