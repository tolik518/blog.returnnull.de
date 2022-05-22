export class TypeASCII
{
    public static fromHex(hex: string): string
    {
        // https://www.codegrepper.com/code-examples/javascript/hex+to+ascii+function+javascript
        hex  = hex.toString().replace(/\s/g, '');

        var ascii = '';
        for (var n = 0; n < hex.length; n += 2) {
            ascii += String.fromCharCode(parseInt(hex.substr(n, 2), 16));
        }

        return ascii;
    }
}