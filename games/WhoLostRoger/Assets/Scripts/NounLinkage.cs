using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class NounLinkage : MonoBehaviour
{
    [Tooltip("The corresponding noun text")]
    public Text nounText;
    [Tooltip("assign to the noun text panel")]
    public IsResult resultTrigger;

    private void isNullArgs()
    {
        if (nounText == null || resultTrigger == null)
        {
            NounLinkage component = this.gameObject.GetComponent<NounLinkage>();
            Destroy(component);

            Debug.Log(string.Format("No corresponding noun text : the component won't work"));
        }
    }

    private void clickNounObject()
    {
        if (nounText.gameObject.activeSelf)
        {
            // save player score here
            PlayerData.saveScore(PlayerData.getScore() + 1);

            nounText.gameObject.SetActive(false);
            Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                this.gameObject.name, nounText.text));

            resultTrigger.isAllNounClicked();
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        clickNounObject();
    }

    // Start is called before the first frame update
    void Start()
    {
        isNullArgs();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
