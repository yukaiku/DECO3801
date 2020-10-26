using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

/*
 * This component script is used for identifying whether a game object is noun 
 * tag object, which corresponding to a noun object, or not.
 * 
 * @inside "IsResult" component script
 * @inside "IsGameover" component script
 * 
 * In Unity inspector,
 * @require Text      nounText
 * 
 */
public class NounTagUtility : MonoBehaviour
{
    // instead of TAG component defined in Unity
    // custom script can be also used for TAG with additional custom functions
    private Text nounText;

    public void isNounNameNull()
    {
        nounText = gameObject.GetComponent<Text>();
        if (nounText == null)
        {
            NounTagUtility component = this.gameObject.GetComponent<NounTagUtility>();
            Destroy(component);

            Debug.Log(string.Format("Null noun tag name : the component won't work."));
        }
    }

    public void setGlobalNounTag()
    {
        DataStorage.setSelectedNounTag(nounText.text);
    }

    /* ********************************************************************************* *
     * ************************* FUNCTIONS ARE SITUATED BELOW ************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isNounNameNull();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
