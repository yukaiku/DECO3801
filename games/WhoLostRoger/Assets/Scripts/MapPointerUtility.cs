using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.EventSystems;
using UnityEngine.UI;

/*
 * This component script is used for providing mouse pointer effects while 
 * hovering on clickable objects in map-based and area-based selection scenes.
 * 
 * In Unity inspector.
 * @require GameObject   levelNoter
 * @require Texture2D    defaultTexture  (optional)
 * @require Texture2D    hoverTexture    (optional)
 * 
 */
public class MapPointerUtility : MonoBehaviour, IPointerEnterHandler, IPointerExitHandler
{
    public Texture2D defaultTexture;
    public Texture2D hoverTexture;
    public CursorMode cursorMode = CursorMode.Auto;
    public Vector2 hotSpot = Vector2.zero;

    private GameObject levelNoter;
    private Image pointerImage;

    public void OnPointerEnter(PointerEventData eventData)
    {
        Cursor.SetCursor(hoverTexture, hotSpot, cursorMode);
        levelNoter.SetActive(true);
    }

    public void OnPointerExit(PointerEventData eventData)
    {
        Cursor.SetCursor(defaultTexture, hotSpot, cursorMode);
        levelNoter.SetActive(false);
    }

    // Start is called before the first frame update
    void Start()
    {
        levelNoter = transform.GetChild(0).gameObject;
        if (levelNoter == null)
        {
            Destroy(this);
            Debug.Log(string.Format("No noter attached to this map pointer and the component won't work"));
        }

        pointerImage = GetComponent<Image>();
        if (pointerImage == null)
        {
            Destroy(this);
            Debug.Log(string.Format("No image component attached to this map pointer and the component won't work"));
        }

        if (pointerImage.mainTexture != null && pointerImage.mainTexture.isReadable)
        {
            pointerImage.alphaHitTestMinimumThreshold = 0.5f;
        }
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
